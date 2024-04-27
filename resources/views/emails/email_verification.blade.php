<h1>Köszöntelek a raktárrendszerben, {{ $user->name }}!</h1>
<p>A regisztrált E-mail címed {{ $user->email }}, Kérlek kattints a szöveg alatti linkre, hogy befejezhesd a regisztrációdat</p>
<p><a href="{{ $verificationUrl }}">Megerősítés</a></p>
<p>Ha nem te regisztráltál, kérlek hagyd figyelmen kívül ezt az e-mailt!</p>
