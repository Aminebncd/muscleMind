import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Paper, Stack, TextField, Button, Typography } from '@mui/material';
import { useAuth } from '../context/AuthContext.jsx';
import { loginRequest } from '../services/apiClient.js';

export default function LoginPage() {
  const [credentials, setCredentials] = useState({ email: '', password: '' });
  const [error, setError] = useState(null);
  const navigate = useNavigate();
  const { login } = useAuth();

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      const token = await loginRequest(credentials);
      login(token);
      navigate('/programs');
    } catch (err) {
      setError('Identifiants invalides.');
    }
  };

  return (
    <Paper elevation={3} sx={{ padding: 4, marginTop: 8 }}>
      <Typography variant="h5" mb={2}>
        Connexion
      </Typography>
      <form onSubmit={handleSubmit}>
        <Stack spacing={2}>
          <TextField
            label="Email"
            type="email"
            value={credentials.email}
            onChange={(event) => setCredentials({ ...credentials, email: event.target.value })}
            required
          />
          <TextField
            label="Mot de passe"
            type="password"
            value={credentials.password}
            onChange={(event) => setCredentials({ ...credentials, password: event.target.value })}
            required
          />
          {error && (
            <Typography color="error" role="alert">
              {error}
            </Typography>
          )}
          <Button type="submit" variant="contained">
            Se connecter
          </Button>
        </Stack>
      </form>
    </Paper>
  );
}
