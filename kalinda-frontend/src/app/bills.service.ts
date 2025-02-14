import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

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

@Injectable({
  providedIn: 'root'
})
export class BillsService {

  constructor(private http: HttpClient) {
  }

  getBills() : Observable<apiResStructure>
  {
    return this.http.get<apiResStructure>("/api/bills", {withCredentials : true});
  }

  getBillWithItems(billId: number)
  {
    return this.http.get("/api/bills/" + billId, {withCredentials: true});
  }

  getAllIssuers()
  {
    return this.http.get("/api/bill_issuers", {withCredentials: true});
  }

  addIssuer(name: string)
  {
    return this.http.post("/api/bill_issuers", {name}, {withCredentials: true});
  }

  addBill(bill : Record<any, any>)
  {
    return this.http.post("/api/bills", {...bill}, {withCredentials : true});
  }

  deleteBillItem(id : number)
  {
    return this.http.delete("/api/bill_items/" + id, {withCredentials: true});
  }

  updateBillItem(id : number, data : Record<any, any>) {
    return this.http.put("/api/bill_items/" + id, data, {withCredentials: true});
  }

  addBillItem(data : any)
  {
    return this.http.post("/api/bill_items", data, {withCredentials : true});
  }
}
