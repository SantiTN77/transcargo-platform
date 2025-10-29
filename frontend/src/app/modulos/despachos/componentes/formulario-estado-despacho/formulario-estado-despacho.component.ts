import { ChangeDetectionStrategy, Component, EventEmitter, Input, OnChanges, Output, SimpleChanges } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-formulario-estado-despacho',
  templateUrl: './formulario-estado-despacho.component.html',
  styleUrls: ['./formulario-estado-despacho.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class FormularioEstadoDespachoComponent implements OnChanges {
  @Input() estadoActual: string | null = null;
  @Input() estadosDisponibles: string[] = [];
  @Input() estaCargando = false;
  @Output() actualizar = new EventEmitter<string>();

  formulario: FormGroup = this.construirFormulario();

  constructor(private readonly formBuilder: FormBuilder) {}

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['estadoActual']) {
      this.formulario.patchValue({ estado: this.estadoActual });
    }

    if (this.estaCargando) {
      this.formulario.disable({ emitEvent: false });
    } else {
      this.formulario.enable({ emitEvent: false });
    }
  }

  enviar(): void {
    if (this.formulario.invalid) {
      this.formulario.markAllAsTouched();
      return;
    }

    this.actualizar.emit(this.formulario.getRawValue().estado);
  }

  private construirFormulario(): FormGroup {
    return this.formBuilder.group({
      estado: [null, Validators.required],
    });
  }
}
