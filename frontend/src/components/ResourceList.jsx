import PropTypes from 'prop-types';
import { List, ListItem, ListItemText, CircularProgress, Alert } from '@mui/material';

export default function ResourceList({ items, isLoading, isError, emptyLabel, onSelect }) {
  if (isLoading) return <CircularProgress data-testid="loader" />;
  if (isError) return <Alert severity="error">Impossible de charger les données.</Alert>;
  if (!items.length) return <Alert severity="info">{emptyLabel}</Alert>;

  return (
    <List>
      {items.map((item) => (
        <ListItem key={item['@id'] ?? item.id} button onClick={() => onSelect?.(item)}>
          <ListItemText primary={item.name} secondary={item.description} />
        </ListItem>
      ))}
    </List>
  );
}

ResourceList.propTypes = {
  items: PropTypes.arrayOf(PropTypes.object).isRequired,
  isLoading: PropTypes.bool,
  isError: PropTypes.bool,
  emptyLabel: PropTypes.string,
  onSelect: PropTypes.func
};

ResourceList.defaultProps = {
  isLoading: false,
  isError: false,
  emptyLabel: 'Aucune ressource disponible',
  onSelect: undefined
};
