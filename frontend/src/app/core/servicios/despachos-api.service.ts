import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';
import { DespachoDetalle } from '../modelos/despacho-detalle.modelo';
import { Novedad } from '../modelos/novedad.modelo';
import { RegistrarNovedadSolicitud } from '../modelos/registrar-novedad-solicitud.modelo';

@Injectable({
  providedIn: 'root',
})
export class DespachosApiService {
  private readonly baseUrl = environment.apiUrl;

  constructor(private readonly http: HttpClient) {}

  obtenerDespacho(idDespacho: number): Observable<DespachoDetalle> {
    return this.http.get<DespachoDetalle>(`${this.baseUrl}/despachos/${idDespacho}`);
  }

  registrarNovedad(solicitud: RegistrarNovedadSolicitud): Observable<Novedad> {
    return this.http.post<Novedad>(`${this.baseUrl}/novedades`, solicitud);
  }
}

