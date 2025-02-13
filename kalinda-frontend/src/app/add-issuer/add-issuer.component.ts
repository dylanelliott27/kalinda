import { Component } from '@angular/core';
import { FormControl, ReactiveFormsModule } from '@angular/forms';
import { BillsService } from '../bills.service';

@Component({
  selector: 'app-add-issuer',
  imports: [ReactiveFormsModule],
  templateUrl: './add-issuer.component.html',
  styleUrl: './add-issuer.component.scss'
})
export class AddIssuerComponent {

  newIssuer = new FormControl()

  constructor(private billService : BillsService)
  {

  }

  addIssuer()
  {
    this.billService.addIssuer(this.newIssuer.value).subscribe(data => console.log(data));
  }
}
