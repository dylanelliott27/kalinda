import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { catchError, switchMap } from 'rxjs';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  imports: [FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})

export class LoginComponent {
  loginEmail: string = '';
  loginPassword: string = '';

  failedLogin: boolean = false;

  constructor(private authService: AuthService, private router: Router) {}

  login() {
    this.failedLogin = false;

    this.authService.login(this.loginEmail, this.loginPassword).subscribe(res => {
      if (res.status === 200) {
        this.router.navigate(["/"]);
      }
    }, err => {
      this.failedLogin = true;
    });
  }
}
