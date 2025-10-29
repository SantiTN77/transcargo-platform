import { ChangeDetectionStrategy, Component, EventEmitter, Input, OnChanges, Output, SimpleChanges } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { RegistrarNovedadSolicitud } from '../../../../core/modelos/registrar-novedad-solicitud.modelo';

@Component({
  selector: 'app-formulario-novedad',
  templateUrl: './formulario-novedad.component.html',
  styleUrls: ['./formulario-novedad.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class FormularioNovedadComponent implements OnChanges {
  @Input() idDespacho: number | null = null;
  @Input() tiposNovedad: string[] = [];
  @Input() estaCargando = false;
  @Output() registrar = new EventEmitter<RegistrarNovedadSolicitud>();

  formulario: FormGroup = this.construirFormulario();

  constructor(private readonly formBuilder: FormBuilder) {}

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['idDespacho'] && this.idDespacho !== null) {
      this.formulario.patchValue({ id_despacho: this.idDespacho });
    }
  }

  enviar(): void {
    if (this.formulario.invalid) {
      this.formulario.markAllAsTouched();
      return;
    }

    this.registrar.emit(this.formulario.getRawValue());
    this.formulario.patchValue({ descripcion: '', fecha: '' });
  }

  private construirFormulario(): FormGroup {
    return this.formBuilder.group({
      id_despacho: [{ value: null, disabled: true }, Validators.required],
      tipo: [null, Validators.required],
      descripcion: [null, [Validators.required, Validators.maxLength(500)]],
      fecha: [null, Validators.required],
    });
  }
}
