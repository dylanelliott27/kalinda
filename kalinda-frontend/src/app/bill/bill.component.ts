import { Component } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { BillsService } from '../bills.service';

@Component({
  selector: 'app-bill',
  imports: [RouterLink],
  templateUrl: './bill.component.html',
  styleUrl: './bill.component.scss'
})
export class BillComponent {

  private billId : number;

  bill : Record<any, any> = {};

  constructor(private route : ActivatedRoute, private billService: BillsService)
  {
    this.billId = Number(route.snapshot.params['id']);

    this.billService.getBillWithItems(this.billId).subscribe(res => {
      this.bill = res;
    });
  }
}
