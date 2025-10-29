import { TestBed } from '@angular/core/testing';
import { of, throwError } from 'rxjs';
import { DespachosApiService } from './despachos-api.service';
import { DespachosFachadaService } from './despachos-fachada.service';

describe('DespachosFachadaService', () => {
  let servicio: DespachosFachadaService;
  let api: jasmine.SpyObj<DespachosApiService>;

  beforeEach(() => {
    api = jasmine.createSpyObj<DespachosApiService>('DespachosApiService', ['obtenerDespacho', 'registrarNovedad', 'actualizarEstado']);

    TestBed.configureTestingModule({
      providers: [
        DespachosFachadaService,
        { provide: DespachosApiService, useValue: api },
      ],
    });

    servicio = TestBed.inject(DespachosFachadaService);
  });

  it('emite despacho cargado correctamente', (done) => {
    api.obtenerDespacho.and.returnValue(of({ id: 1, conductor: '', vehiculo: '', estado: '', fecha: '', novedades: [], mensaje_novedades: null, historial_estados: [] }));

    servicio.observarDespacho().subscribe((valor) => {
      if (valor) {
        expect(valor.id).toBe(1);
        done();
      }
    });

    servicio.cargarDespacho(1);
  });

  it('propaga error al fallar la carga', (done) => {
    api.obtenerDespacho.and.returnValue(throwError(() => new Error('Fallo')));

    servicio.observarError().subscribe((mensaje) => {
      if (mensaje) {
        expect(mensaje).toContain('No fue posible cargar el despacho');
        done();
      }
    });

    servicio.cargarDespacho(1);
  });

  it('actualiza el estado del despacho exitosamente', (done) => {
    const detalleActualizado = { id: 2, conductor: '', vehiculo: '', estado: 'Entregado', fecha: '', novedades: [], mensaje_novedades: null, historial_estados: [] };
    api.actualizarEstado.and.returnValue(of(detalleActualizado));

    servicio.observarDespacho().subscribe((valor) => {
      if (valor?.id === 2 && valor.estado === 'Entregado') {
        expect(api.actualizarEstado).toHaveBeenCalledWith(2, 'Entregado');
        done();
      }
    });

    servicio.actualizarEstado(2, 'Entregado');
  });

  it('notifica error cuando falla la actualización de estado', (done) => {
    api.actualizarEstado.and.returnValue(throwError(() => new Error('Fallo')));

    servicio.observarError().subscribe((mensaje) => {
      if (mensaje) {
        expect(mensaje).toContain('No fue posible actualizar el estado');
        done();
      }
    });

    servicio.actualizarEstado(3, 'Entregado');
  });
});

