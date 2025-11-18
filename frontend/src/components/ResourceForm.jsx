import PropTypes from 'prop-types';
import { useState } from 'react';
import { Stack, TextField, Button } from '@mui/material';

export default function ResourceForm({ onSubmit, initialValues = { name: '', description: '' }, ctaLabel }) {
  const [values, setValues] = useState(initialValues);

  const handleChange = (event) => {
    setValues({ ...values, [event.target.name]: event.target.value });
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    onSubmit(values);
  };

  return (
    <form onSubmit={handleSubmit}>
      <Stack spacing={2}>
        <TextField name="name" label="Nom" value={values.name} onChange={handleChange} required />
        <TextField
          name="description"
          label="Description"
          value={values.description}
          onChange={handleChange}
          multiline
          rows={3}
        />
        <Button type="submit" variant="contained">
          {ctaLabel}
        </Button>
      </Stack>
    </form>
  );
}

ResourceForm.propTypes = {
  onSubmit: PropTypes.func.isRequired,
  initialValues: PropTypes.shape({
    name: PropTypes.string,
    description: PropTypes.string
  }),
  ctaLabel: PropTypes.string
};

ResourceForm.defaultProps = {
  initialValues: { name: '', description: '' },
  ctaLabel: 'Enregistrer'
};
