import { Component } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { BillsService } from '../bills.service';
import { FormGroup, ReactiveFormsModule, FormControl, FormArray } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';
type Provider = {
  id : number,
  name : string
};
@Component({
  selector: 'app-add-bill',
  imports: [RouterLink, ReactiveFormsModule, CommonModule],
  templateUrl: './add-bill.component.html',
  styleUrl: './add-bill.component.scss'
})

export class AddBillComponent {
  private billId : number;

  bill : Record<any, any> = {};

  providers : Provider[] = [];

  billForm: FormGroup;

  constructor(private route : ActivatedRoute, private billService : BillsService, private router : Router){
    this.billId = Number(route.snapshot.params['id']);

    this.billService.getAllIssuers().subscribe((data : any) => {
      this.providers = data;

      if (!isNaN(this.billId)) {
        this.billService.getBillWithItems(this.billId).subscribe((data : Record<any, any>) => {
          this.bill = data;
  
          const billItems : any[] = this.bill['bill_items'].map((item: any) => new FormGroup({
            id : new FormControl(item.id),
            amount : new FormControl(item.amount),
            bill_issuer_id : new FormControl(item.bill_issuer.id)
          }));
          
          this.billForm = new FormGroup({
            "due_date" : new FormControl(this.bill['due_date']),
            "id" : new FormControl(this.bill['id']),
            "bill_items" : new FormArray(billItems)
          });
  
          return;
        });
      }
  
      this.billForm = new FormGroup({
        "due_date" : new FormControl(''),
        "bill_items" : new FormArray([])
      });

    });

    this.billForm = new FormGroup({
      "due_date" : new FormControl(''),
      "bill_items" : new FormArray([])
    });
  }

  onSubmit()
  {
    this.billService.addBill(this.billForm.value).subscribe((data : any) => {
      this.router.navigate(["/bill/" + data.id]);
    });
  }

  get billItems()
  {
    return this.billForm.get('bill_items') as FormArray;
  }

  addBillItem()
  {
    this.billItems.push(new FormGroup({
      id : new FormControl(null),
      amount : new FormControl(),
      bill_issuer_id : new FormControl()
    }))
  }

  deleteBillItem(index: number, billItem : any)
  {
    this.billService.deleteBillItem(billItem.value.id).subscribe(data => {
      this.billItems.removeAt(index);
    });
  }

  amountChange(billItem : any)
  {
    if (!billItem.value.id) {
      return;
    }

    this.billService.updateBillItem(billItem.value.id, {"amount" : billItem.value.amount}).subscribe(data => {
      
    });
  }

  providerChange(billItem : any)
  {
    if (!billItem.value.id) {
      return;
    }

    this.billService.updateBillItem(billItem.value.id, {"bill_issuer_id" : billItem.value.bill_issuer_id}).subscribe(data => {
      
    });}

  saveNewBillItem(index : number, data : any)
  {
    this.billService.addBillItem({...data.value, bill_id : this.bill['id']}).subscribe((data: any) => {
      console.log(data.id);
      this.billItems.at(index).patchValue({id : data.id})
    })
  }
}

