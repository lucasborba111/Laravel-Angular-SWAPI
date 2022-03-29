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
        this.movie[i].planets_id=this.movie[i].planets_id.split("")
        this.movie[i].planets=this.movie[i].planets.split(",")
      }  
      for(let i=0; i<this.movie?.length;i++){
        this.movie[i].people_id=this.movie[i].people_id.split(",")
        this.movie[i].people=this.movie[i].people.split(",")
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
  show_people(id:string){
    this.service.people_show(id).subscribe(dados =>{
      alert('NAME: '+dados.name+'\n'+'BIRTH YEAR: '+dados.birth_year+'\n'+'GENDER:'+dados.gender+'\n'+'FILMS: '+dados.films);
    });
  }
}
