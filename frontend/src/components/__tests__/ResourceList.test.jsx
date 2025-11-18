import { describe, it, expect } from 'vitest';
import { render, screen } from '@testing-library/react';
import ResourceList from '../ResourceList.jsx';

describe('ResourceList', () => {
  it('affiche un message lorsque la liste est vide', () => {
    render(<ResourceList items={[]} emptyLabel="Aucun élément" />);
    expect(screen.getByText('Aucun élément')).toBeInTheDocument();
  });
});
