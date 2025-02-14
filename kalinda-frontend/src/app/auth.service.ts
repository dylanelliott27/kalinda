import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { concatMap, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http : HttpClient) { }

  isAuthenticated()
  {
    return this.http.get('/api/getAuthStatus', { observe: "response", withCredentials: true, headers : {'Accept' : 'application/json'}});
  }

  getCsrfToken()
  {
    return this.http.get('/api/sanctum/csrf-cookie', { withCredentials: true })
  }

  login(email: string, password: string)
  {
    return this.getCsrfToken().pipe(concatMap(csrfResponse => this.http.post('/api/login', { email, password }, { observe: "response", withCredentials: true })));
  }

  register(email: string, password: string, name: string)
  {
    return this.http.post('/api/register', { email, password, name }, { withCredentials: true })
  }

  logout()
  {
    return this.http.post('/api/logout', null, { withCredentials: true });
  }
}
