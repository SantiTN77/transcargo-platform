import { ChangeDetectionStrategy, Component, OnDestroy, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject, takeUntil } from 'rxjs';
import { DespachosFachadaService } from '../../../../core/servicios/despachos-fachada.service';
import { RegistrarNovedadSolicitud } from '../../../../core/modelos/registrar-novedad-solicitud.modelo';

@Component({
  selector: 'app-pagina-despacho',
  templateUrl: './pagina-despacho.component.html',
  styleUrls: ['./pagina-despacho.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class PaginaDespachoComponent implements OnInit, OnDestroy {
  readonly despacho$ = this.fachada.observarDespacho();
  readonly cargando$ = this.fachada.observarCargando();
  readonly error$ = this.fachada.observarError();
  readonly tiposNovedad = ['Retraso', 'Transbordo', 'Daño', 'Cancelación'];
  readonly estadosDespacho = ['En ruta', 'Entregado', 'Retrasado', 'Cancelado'];

  private readonly destruir$ = new Subject<void>();
  private idDespachoActual: number | null = null;

  constructor(
    private readonly ruta: ActivatedRoute,
    private readonly fachada: DespachosFachadaService
  ) {}

  ngOnInit(): void {
    this.ruta.paramMap.pipe(takeUntil(this.destruir$)).subscribe((parametros) => {
      const id = Number(parametros.get('id'));
      if (!Number.isNaN(id)) {
        this.idDespachoActual = id;
        this.fachada.cargarDespacho(id);
      }
    });
  }

  ngOnDestroy(): void {
    this.destruir$.next();
    this.destruir$.complete();
  }

  manejarRegistroNovedad(solicitud: RegistrarNovedadSolicitud): void {
    if (this.idDespachoActual === null) {
      return;
    }

    this.fachada.registrarNovedad({
      ...solicitud,
      id_despacho: this.idDespachoActual,
    });
  }

  manejarActualizacionEstado(estado: string): void {
    if (this.idDespachoActual === null) {
      return;
    }

    this.fachada.actualizarEstado(this.idDespachoActual, estado);
  }
}

