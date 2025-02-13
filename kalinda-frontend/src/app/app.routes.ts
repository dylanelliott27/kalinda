import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { authGuard } from './auth.guard';
import { BillsComponent } from './bills/bills.component';
import { AddBillComponent } from './add-bill/add-bill.component';
import { BillComponent } from './bill/bill.component';
import { AddIssuerComponent } from './add-issuer/add-issuer.component';

export const routes: Routes = [
    {
        path: '',
        component: HomeComponent,
        canActivate: [authGuard]
    },
    {
        path: 'login',
        component: LoginComponent
    },
    {
        path: 'register',
        component: RegisterComponent
    },
    {
        path: 'bills',
        component: BillsComponent,
        canActivate: [authGuard]
    },
    {
        path: 'addBill',
        component: AddBillComponent,
        canActivate: [authGuard]
    },
    {
        path: 'addBill/:id',
        component: AddBillComponent,
        canActivate: [authGuard]
    },
    {
        path: 'bill/:id',
        component: BillComponent,
        canActivate: [authGuard]
    },
    {
        path: 'addIssuer',
        component: AddIssuerComponent,
        canActivate: [authGuard]
    }
];
