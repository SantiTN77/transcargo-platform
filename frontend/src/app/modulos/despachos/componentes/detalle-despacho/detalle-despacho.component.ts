import { ChangeDetectionStrategy, Component, Input } from '@angular/core';
import { DespachoDetalle } from '../../../../core/modelos/despacho-detalle.modelo';

@Component({
  selector: 'app-detalle-despacho',
  templateUrl: './detalle-despacho.component.html',
  styleUrls: ['./detalle-despacho.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class DetalleDespachoComponent {
  @Input() despacho: DespachoDetalle | null = null;
  @Input() estaCargando = false;
  @Input() mensajeError: string | null = null;
}

