import axios from 'axios';

export const apiClient = (token) =>
  axios.create({
    baseURL: 'http://localhost:8000',
    headers: {
      'Content-Type': 'application/json',
      ...(token ? { Authorization: `Bearer ${token}` } : {})
    }
  });

export const loginRequest = async ({ email, password }) => {
  const { data } = await axios.post('http://localhost:8000/auth/login', { email, password });
  return data.token;
};
