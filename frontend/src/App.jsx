import { Routes, Route, Navigate } from 'react-router-dom';
import Container from '@mui/material/Container';
import LoginPage from './pages/LoginPage.jsx';
import ProgramsPage from './pages/ProgramsPage.jsx';
import SessionsPage from './pages/SessionsPage.jsx';
import { useAuth } from './context/AuthContext.jsx';

const PrivateRoute = ({ children }) => {
  const { isAuthenticated } = useAuth();
  return isAuthenticated ? children : <Navigate to="/login" replace />;
};

export default function App() {
  return (
    <Container maxWidth="lg">
      <Routes>
        <Route path="/login" element={<LoginPage />} />
        <Route
          path="/programs"
          element={
            <PrivateRoute>
              <ProgramsPage />
            </PrivateRoute>
          }
        />
        <Route
          path="/sessions/:programId"
          element={
            <PrivateRoute>
              <SessionsPage />
            </PrivateRoute>
          }
        />
        <Route path="*" element={<Navigate to="/programs" replace />} />
      </Routes>
    </Container>
  );
}
