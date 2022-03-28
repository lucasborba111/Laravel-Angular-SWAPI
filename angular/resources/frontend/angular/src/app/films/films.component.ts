import { Component, OnInit } from '@angular/core';
import { BackendService } from './../backend.service';
import { Movie } from './../movie';

@Component({
  selector: 'app-films',
  templateUrl: './films.component.html',
  styleUrls: ['./films.component.css']
})
export class FilmsComponent implements OnInit {

  movie:Movie[]=[];
  filter = [];
  constructor(private service: BackendService) { }
  

  ngOnInit(): void {
    this.service.movie_list().subscribe(dados=>{
      this.movie=dados;
      for(let i=0; i<this.movie?.length;i++){
        this.movie[i].planets = dados[i].planets.match(/\d+/g);
      }  
      console.log(this.movie)
    });

  }
  movie_filter(nome:string){
   var filtrado =  this.movie.filter(function(titulo) {
      return titulo.title == nome;
    });
    if(filtrado){
      this.movie = filtrado
    }
  }
  show_world(id:string){
    this.service.world_show(id).subscribe(dados =>{
      alert('NAME: '+dados.name+'\n'+'ROTATION PERIOD: '+dados.rotation_period+'\n'+'ORBITAL PERIOD:'+dados.orbital_period+'\n'+'DIAMETER: '+dados.diameter+'\n'+'CLIMATE: '+dados.climate);
    });
  }

}
