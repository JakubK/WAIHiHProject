<nav class="navigation">
  <div class="dropdown-button">
    Strona główna
    <ul class="dropdown">
      <li class="dropdown--item"><a href="/#beginnings">Początki</a></li>
      <li class="dropdown--item"><a href="/#projects">Wybrane projekty</a></li>
      <li class="dropdown--item"><a href="/#contact">Kontakt</a></li>
    </ul>
  </div>
  <a class="<?=$_SERVER['REQUEST_URI'] === '/gallery' ? 'nav-active' : ''?>" href="/gallery">Galeria</a>
  <a class="<?=$_SERVER['REQUEST_URI'] === '/contact' ? 'nav-active' : ''?>" href="/contact">Kontakt</a>
</nav>