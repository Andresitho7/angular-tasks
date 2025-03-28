import { Component, OnInit, ViewChild } from '@angular/core';
import { TaskService } from 'src/app/services/services/task.service';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {

  tasks: any[] = [];

  constructor(private taskService: TaskService) {}

  ngOnInit(): void {
    this.loadTasks();
  }

  loadTasks(): void {
    this.taskService.getTasks().subscribe((data: any) => {
      this.tasks = data;
    });
  }

  selectedTask: any = { title: '', description: '', status: 'pendiente' };

  editTask(task: any): void {
    this.selectedTask = { ...task }; // Cargar la tarea en el formulario
  }
  
  deleteTask(id: number): void {
    this.taskService.deleteTask(id).subscribe({
      next: (response) => {
        console.log('Tarea eliminada:', response);
        this.loadTasks(); // Refrescar la lista después de eliminar
      },
      error: (err) => {
        console.error('Error eliminando tarea:', err);
      }
    });
  }

}
