import { Component, OnInit } from '@angular/core';
import { BackendService } from './../backend.service';
import { Movie } from './../movie';

@Component({
  selector: 'app-films',
  templateUrl: './films.component.html',
  styleUrls: ['./films.component.css']
})
export class FilmsComponent implements OnInit {

  movie:Movie[];
  filter = [];
  constructor(private service: BackendService) { }
  

  ngOnInit(): void {
    
    this.service.movie_list().subscribe(dados =>this.movie = dados);
  }
  movie_filter(nome:string){
   var filtrado =  this.movie.filter(function(titulo) {
      return titulo.title == nome;
    });
    if(filtrado){
      this.movie = filtrado
    }
  }

}
