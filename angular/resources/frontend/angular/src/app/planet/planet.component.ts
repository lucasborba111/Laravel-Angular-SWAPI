import { Component, OnInit } from '@angular/core';
import { BackendService } from '../backend.service';
import { World } from './../world';
@Component({
  selector: 'app-planet',
  templateUrl: './planet.component.html',
  styleUrls: ['./planet.component.css']
})
export class PlanetComponent implements OnInit {
  world: World[]
  constructor(private service: BackendService) { }

  ngOnInit(): void {
    this.service.world_list().subscribe(dados =>this.world = dados);
  }
  world_filter(nome:string){
    var filtrado =  this.world.filter(function(planet) {
       return planet.name == nome;
     });
     if(filtrado){
       this.world = filtrado
     }
   }
}
