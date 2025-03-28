import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map, Observable, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TaskService {

  private apiURL = 'http://localhost/CRUD/api/tasks.php';

  constructor( private http: HttpClient) { }

  //Extrae las tareas de la base de datos
  // getTasks(): Observable<any> {
  //   // return this.http.get(this.apiURL);
  //   return this.http.get(`${this.apiURL}`);
  // }

  getTasks(): Observable<any[]> {
    return this.http.get<any[]>(this.apiURL).pipe(
      tap(data => console.log("Respuesta de la API:", data))
    );
  }

  //Crea una tarea en la base de datos
  createTask(task: any): Observable<any> {
    return this.http.post(this.apiURL, task);
  }

  //Actualiza una tarea en la base de datos
  updateTask(task: any): Observable<any> {
    return this.http.put(`${this.apiURL}/${task.id}`, task, {
      headers: { 'Content-Type': 'application/json' }
    });
  }
  

  //Elimina una tarea de la base de datos
  deleteTask(id: number): Observable<any> {
    return this.http.delete<any>(this.apiURL, {
      body: { id } // Enviar el ID en el cuerpo de la solicitud
    });
  }
}
