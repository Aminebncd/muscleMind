import { useState } from 'react';
import { Typography, Grid, Paper } from '@mui/material';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useAuth } from '../context/AuthContext.jsx';
import { apiClient } from '../services/apiClient.js';
import ResourceList from '../components/ResourceList.jsx';
import ResourceForm from '../components/ResourceForm.jsx';

export default function ProgramsPage() {
  const { token } = useAuth();
  const [selectedProgram, setSelectedProgram] = useState(null);
  const queryClient = useQueryClient();
  const client = apiClient(token);

  const { data, isLoading, isError } = useQuery({
    queryKey: ['programs'],
    queryFn: async () => {
      const { data: response } = await client.get('/training_programs');
      return response['hydra:member'] ?? [];
    }
  });

  const mutation = useMutation({
    mutationFn: async (payload) => client.post('/training_programs', payload),
    onSuccess: () => queryClient.invalidateQueries({ queryKey: ['programs'] })
  });

  return (
    <Grid container spacing={4} mt={4}>
      <Grid item xs={12} md={6}>
        <Paper sx={{ padding: 3 }}>
          <Typography variant="h6" mb={2}>
            Programmes
          </Typography>
          <ResourceList
            items={data ?? []}
            isLoading={isLoading}
            isError={isError}
            emptyLabel="Aucun programme publié"
            onSelect={setSelectedProgram}
          />
        </Paper>
      </Grid>
      <Grid item xs={12} md={6}>
        <Paper sx={{ padding: 3 }}>
          <Typography variant="h6" mb={2}>
            Créer un programme
          </Typography>
          <ResourceForm
            ctaLabel="Publier"
            onSubmit={(payload) => mutation.mutate({ ...payload, isPublished: true })}
          />
          {selectedProgram && (
            <Typography mt={3}>
              Dernier programme sélectionné : <strong>{selectedProgram.name}</strong>
            </Typography>
          )}
        </Paper>
      </Grid>
    </Grid>
  );
}
