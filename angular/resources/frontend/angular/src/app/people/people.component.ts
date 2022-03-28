import { Component, OnInit } from '@angular/core';
import { People } from './../people';

import { BackendService } from '../backend.service';
import { Movie } from './../movie';
@Component({
  selector: 'app-people',
  templateUrl: './people.component.html',
  styleUrls: ['./people.component.css']
})
export class PeopleComponent implements OnInit {
  people: People[];
  movie: Movie[];
  constructor(private service:BackendService) { }

  ngOnInit(): void {
    this.service.people_list().subscribe(dados =>{
      this.people=dados;
      for(let i=0; i<this.people?.length;i++){
        this.people[i].films = dados[i].films.match(/\d+/g);
      }  
    });
   
  }
  people_filter(nome:string){
    var filtrado =  this.people.filter(function(person) {
       return person.name == nome;
     });
     if(filtrado){
       this.people = filtrado
     }
   }
   show_films(id:string){
    this.service.movie_show(id).subscribe(dados =>{
      alert('TITLE: '+dados.title+'\n'+'EPISODE ID: '+dados.episode_id+"\n"+'OPENING CRAWl: '+dados.opening_crawl);
    });
   }
}
