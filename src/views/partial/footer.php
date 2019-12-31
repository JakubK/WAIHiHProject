<footer>
  Autor: 180125
  <?php if(!empty($_SESSION['user'])): ?>
    <a href="/logout">Wyloguj się</a>
  <?php else:?>
    <span>Użytkownik niezalogowany. 
      <a href="/login">Zaloguj się</a>
      lub
      <a href="/register">Stwórz konto</a>
    </span>
  <?php endif?>|
  <a href="/marked">Zobacz zapamiętane zdjęcia</a>

</footer>