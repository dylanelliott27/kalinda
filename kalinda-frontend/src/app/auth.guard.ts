import { CanActivateFn, GuardResult, RedirectCommand, Router, RouterLink } from '@angular/router';
import { AuthService } from './auth.service';
import { inject } from '@angular/core';
import { catchError, map, of, switchMap } from 'rxjs';

export const authGuard: CanActivateFn = (route, state) => {
  const authService: AuthService = inject(AuthService);
  const router: Router = inject(Router);

  return authService.isAuthenticated().pipe(catchError(err => of(err)), map((response: any) : RedirectCommand | boolean => {
    if (response.status !== 200) {
      return new RedirectCommand(router.parseUrl("/login"));
    }

    return true;
  }));
};
