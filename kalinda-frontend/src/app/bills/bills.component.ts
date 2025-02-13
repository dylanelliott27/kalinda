import { Component } from '@angular/core';
import { BillsService } from '../bills.service';
import { RouterLink } from '@angular/router';

type apiResStructure = {
  "current_page" : number,
  "data" : any[],
  "first_page_url" : string,
  "from" : number,
  "last_page" : number,
  "last_page_url" : string,
  "links" : any[],
  "next_page_url" : string,
  "path" : string,
  "per_page" : number,
  "prev_page_url" : string|null,
  "to" : number,
  "total" : number
}

@Component({
  selector: 'app-bills',
  imports: [RouterLink],
  templateUrl: './bills.component.html',
  styleUrl: './bills.component.scss'
})
export class BillsComponent {
  bills: any[] = [];

  constructor(private billService: BillsService )
  {
    this.billService.getBills().subscribe((res: apiResStructure) => {
      console.log(res);
      this.bills = res.data;
    });
  }
}
