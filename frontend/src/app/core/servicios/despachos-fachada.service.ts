import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { DespachoDetalle } from '../modelos/despacho-detalle.modelo';
import { RegistrarNovedadSolicitud } from '../modelos/registrar-novedad-solicitud.modelo';
import { DespachosApiService } from './despachos-api.service';

@Injectable({
  providedIn: 'root',
})
export class DespachosFachadaService {
  private readonly despacho$ = new BehaviorSubject<DespachoDetalle | null>(null);
  private readonly cargando$ = new BehaviorSubject<boolean>(false);
  private readonly error$ = new BehaviorSubject<string | null>(null);
  private ultimoDespachoConsultado: number | null = null;

  constructor(private readonly api: DespachosApiService) {}

  observarDespacho() {
    return this.despacho$.asObservable();
  }

  observarCargando() {
    return this.cargando$.asObservable();
  }

  observarError() {
    return this.error$.asObservable();
  }

  cargarDespacho(idDespacho: number): void {
    this.cargando$.next(true);
    this.error$.next(null);
    this.ultimoDespachoConsultado = idDespacho;

    this.api.obtenerDespacho(idDespacho).subscribe({
      next: (detalle) => {
        this.despacho$.next(detalle);
        this.cargando$.next(false);
      },
      error: () => {
        this.despacho$.next(null);
        this.error$.next('No fue posible cargar el despacho.');
        this.cargando$.next(false);
      },
    });
  }

  registrarNovedad(solicitud: RegistrarNovedadSolicitud): void {
    this.cargando$.next(true);
    this.error$.next(null);

    this.api.registrarNovedad(solicitud).subscribe({
      next: () => {
        if (this.ultimoDespachoConsultado !== null) {
          this.cargarDespacho(this.ultimoDespachoConsultado);
        } else {
          this.cargando$.next(false);
        }
      },
      error: () => {
        this.error$.next('No fue posible registrar la novedad.');
        this.cargando$.next(false);
      },
    });
  }
}
