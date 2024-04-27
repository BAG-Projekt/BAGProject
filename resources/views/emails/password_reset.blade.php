<h1>Jelszó helyreállítás</h1>
<h2>Üdv,</h2>
<p>Azért kaptad ezt az E-mailt, mert jelszó helyreállítást kértél a fiókodhoz.</p>
<p><a href="{{ url('reset-password/' . $token . '?email=' . urlencode($email)) }}">Jelszó helyreállítása</a></p>
<p>Amennyiben nem kedvezményeztél jelszó helyreállítást, tekintsd ezt az E-mailt tárgytalannak.</p>
