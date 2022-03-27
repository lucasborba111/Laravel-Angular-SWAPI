import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import {NgbPaginationModule, NgbAlertModule} from '@ng-bootstrap/ng-bootstrap';
import { PlanetComponent } from './planet/planet.component';
import { PeopleComponent } from './people/people.component';
import { FilmsComponent } from './films/films.component';
import { HttpClientModule } from '@angular/common/http';
@NgModule({
  declarations: [
    AppComponent,
    PlanetComponent,
    PeopleComponent,
    FilmsComponent
  ],
  imports: [
    RouterModule.forRoot([
                          {path:'planets', component: PlanetComponent},
                          {path:'people', component: PeopleComponent},
                          {path:'films', component: FilmsComponent}]),
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    HttpClientModule,
    [NgbPaginationModule, NgbAlertModule]
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
