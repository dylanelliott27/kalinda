import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { switchMap } from 'rxjs';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-register',
  imports: [FormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent {
  email: string = '';
  password: string = '';
  name: string = '';

  constructor(private authService: AuthService) {}

  register() {
    return this.authService.register(this.email, this.password, this.name).subscribe(data => {console.log(data)});
  }
}
