import { TestBed } from '@angular/core/testing';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';
import { DespachosApiService } from './despachos-api.service';
import { environment } from '../../../environments/environment';

describe('DespachosApiService', () => {
  let service: DespachosApiService;
  let httpMock: HttpTestingController;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule],
      providers: [DespachosApiService],
    });

    service = TestBed.inject(DespachosApiService);
    httpMock = TestBed.inject(HttpTestingController);
  });

  afterEach(() => {
    httpMock.verify();
  });

  it('solicita un despacho por id', () => {
    service.obtenerDespacho(5).subscribe();

    const solicitud = httpMock.expectOne(`${environment.apiUrl}/despachos/5`);
    expect(solicitud.request.method).toBe('GET');
    solicitud.flush({});
  });

  it('registra una novedad', () => {
    const payload = {
      id_despacho: 5,
      tipo: 'Retraso',
      descripcion: 'Retraso por consulta',
      fecha: '2025-11-05 10:00:00',
    };

    service.registrarNovedad(payload).subscribe();

    const solicitud = httpMock.expectOne(`${environment.apiUrl}/novedades`);
    expect(solicitud.request.method).toBe('POST');
    expect(solicitud.request.body).toEqual(payload);
    solicitud.flush({});
  });
});

