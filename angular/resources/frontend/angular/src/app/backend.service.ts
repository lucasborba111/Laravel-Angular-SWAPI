import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Movie } from './movie';
import { tap } from 'rxjs';
import { People } from './people';
import { World } from './world';
@Injectable({
  providedIn: 'root'
})
export class BackendService {
  private readonly API_MOVIE = 'http://127.0.0.1:8000/movie';
  private readonly API_PEOPLE = 'http://127.0.0.1:8000/people';
  private readonly API_WORLD = 'http://127.0.0.1:8000/world';


  constructor(private http:HttpClient) { }
  movie_list(){
      return this.http.get<Movie[]>(this.API_MOVIE).pipe(tap(console.log));
  }
  people_list(){
    return this.http.get<People[]>(this.API_PEOPLE).pipe(tap(console.log));
  }
  world_list(){
    return this.http.get<World[]>(this.API_WORLD).pipe(tap(console.log));
  }

  movie_show(id:string){
    return this.http.get<Movie[]>(this.API_MOVIE+'/'+id).pipe(tap(console.log));
  }
  world_show(id:string){
    return this.http.get<World[]>(this.API_WORLD+'/'+id).pipe(tap(console.log));
  }
}
