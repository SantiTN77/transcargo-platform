import { HistorialEstado } from './historial-estado.modelo';
import { Novedad } from './novedad.modelo';

export interface DespachoDetalle {
  id: number;
  conductor: string;
  vehiculo: string;
  estado: string;
  fecha: string;
  novedades: Novedad[];
  mensaje_novedades: string | null;
  historial_estados: HistorialEstado[];
}

