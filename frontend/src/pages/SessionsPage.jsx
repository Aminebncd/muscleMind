import { useParams } from 'react-router-dom';
import { useQuery } from '@tanstack/react-query';
import { Typography, Paper, List, ListItem, ListItemText } from '@mui/material';
import { useAuth } from '../context/AuthContext.jsx';
import { apiClient } from '../services/apiClient.js';

export default function SessionsPage() {
  const { programId } = useParams();
  const { token } = useAuth();
  const client = apiClient(token);

  const { data, isLoading } = useQuery({
    queryKey: ['sessions', programId],
    queryFn: async () => {
      const { data: response } = await client.get('/training_sessions', {
        params: { 'program.id': programId }
      });
      return response['hydra:member'] ?? [];
    }
  });

  return (
    <Paper sx={{ padding: 3, marginTop: 4 }}>
      <Typography variant="h5" mb={2}>
        Sessions du programme #{programId}
      </Typography>
      {isLoading ? (
        <Typography>Chargement...</Typography>
      ) : (
        <List>
          {data.map((session) => (
            <ListItem key={session['@id'] ?? session.id}>
              <ListItemText
                primary={`Séance du ${new Date(session.scheduledAt).toLocaleDateString('fr-FR')}`}
                secondary={`${session.durationMinutes} min - Intensité: ${session.intensity}`}
              />
            </ListItem>
          ))}
        </List>
      )}
    </Paper>
  );
}
