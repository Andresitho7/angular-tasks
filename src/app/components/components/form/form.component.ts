import { Component, Input, Output, EventEmitter } from '@angular/core';
import { TaskService } from 'src/app/services/services/task.service';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.css']
})
export class FormComponent {

  @Input()
  task: any = { title: '', description: '', status: 'pendiente' };

  @Output()
  taskSaved = new EventEmitter<void>();

  @Output()
  taskDeleted = new EventEmitter<void>();

  constructor(private taskService: TaskService) { }

  saveTask() {
    if (this.task.id) {
      // Actualizar tarea
      this.taskService.updateTask(this.task).subscribe(response => {
        console.log("Tarea actualizada", response);
        //this.refreshTaskList(); // Actualizar la lista de tareas
        this.taskSaved.emit(); // Emitir evento para indicar que la tarea ha sido guardada
      });
    } else {
      // Crear nueva tarea
      this.taskService.createTask(this.task).subscribe(response => {
        console.log("Tarea creada", response);
        //this.refreshTaskList(); // Actualizar la lista de tareas
        this.taskSaved.emit();
      });
    }

    // Limpiar el formulario después de guardar
    this.task = { title: '', description: '', status: 'pendiente' };
  
  }

  deleteTask() {
    if (this.task.id) {
      this.taskService.deleteTask(this.task.id).subscribe(response => {
        console.log("Tarea eliminada", response);
        this.taskDeleted.emit(); // Emitir evento para actualizar la lista
        this.task = { id: null, title: '', description: '', status: 'pendiente' }; // Resetear el formulario
      }, error => {
        console.error("Error al eliminar tarea", error);
      });
    }
  }
}
