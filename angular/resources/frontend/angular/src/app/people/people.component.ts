import { Component, OnInit } from '@angular/core';
import { People } from './../people';
import { BackendService } from '../backend.service';
@Component({
  selector: 'app-people',
  templateUrl: './people.component.html',
  styleUrls: ['./people.component.css']
})
export class PeopleComponent implements OnInit {
  people: People[];
  constructor(private service:BackendService) { }

  ngOnInit(): void {
    this.service.people_list().subscribe(dados =>this.people = dados);
  }
  people_filter(nome:string){
    var filtrado =  this.people.filter(function(person) {
       return person.name == nome;
     });
     if(filtrado){
       this.people = filtrado
     }
   }
}
