import { Component, OnInit } from '@angular/core';
import { BackendService } from '../backend.service';
import { World } from './../world';
@Component({
  selector: 'app-planet',
  templateUrl: './planet.component.html',
  styleUrls: ['./planet.component.css']
})
export class PlanetComponent implements OnInit {
  world: World[]=[]
  constructor(private service: BackendService) { }

  ngOnInit(): void {
    this.service.world_list().subscribe(dados =>{
      this.world=dados;
      for(let i=0; i<this.world?.length;i++){
        this.world[i].films = dados[i].films.match(/\d+/g);
      }  
    });
  }
  world_filter(nome:string){
    var filtrado =  this.world.filter(function(planet) {
       return planet.name == nome;
     });
     if(filtrado){
       this.world = filtrado
     }
   }
   show_films(id:string){
    this.service.movie_show(id).subscribe(dados =>{
      alert('TITLE: '+dados.title+'\n'+'EPISODE ID: '+dados.episode_id+"\n"+'OPENING CRAWl: '+dados.opening_crawl);
    });
   }
}
