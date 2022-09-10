<div id="topbar" class="d-flex align-items-center topbar-inner-pages">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <ul class="d-flex">
                <li class="mr-3">
                    <i class="lnr lnr-envelope" style="color: white;"></i>
                    <a href="mail:info@micmusomesa.com" style="color: white; text-decoration: none;">
                        info@micmusomesa.com
                    </a>
                </li>
                <li>
                    <i class="lnr lnr-phone" style="color: white;"></i>
                    <a href="tel:+250790140002" style="color: white; text-decoration: none;">
                        +250 790 140 002
                    </a>
                </li>
            </ul>
        </div>
        <div class="cta d-none d-md-block">
            <ul class="d-flex">
                <?php
                    $statement = $pdo->prepare("SELECT * FROM social_media");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) { ?>
                    <?php if($row['url'] != ''): ?>
                        <li>
                            <a href="<?php echo $row['url']; ?>" class="scrollto">
                                <i class="<?php echo $row['icon']; ?>" style="color: white;"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="./" class="logo">
            <img src="assets/img/logo.png" alt="" class="img-fluid">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="./">Home</a></li>
                <li><a class="nav-link scrollto" href="about.php">About Us</a></li>
                <li class="dropdown">
                    <a href="">
                        Projects
                    </a>
                    <ul>
                        <?php
							$statement = $pdo->prepare("SELECT * FROM categories WHERE status = 1");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) { ?>
                            <li class="dropdown">
                                <a href="#!"><?php echo $row['name'] ?></a>
                                <ul>
                                	<?php
										$statement1 = $pdo->prepare("SELECT * FROM projects WHERE name=?");
										$statement1->execute(array($row['name']));
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
										foreach ($result1 as $row1) { ?>
	                                    <li>
	                                        <a href="project-show.php?id=<?php echo $row['id'] ?>">
	                                            <?php echo $row1['name'] ?>
	                                        </a>
	                                    </li>
	                                <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <span>Properties</span> 
                    </a>
                    <ul>
                        <li class="dropdown">
                            <a href="property-sale.php">
                                <span>For Sale</span> 
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="property-rent.php">
                                <span>For Rent</span> 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        Services
                    </a>
                    <ul>
                        <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM services WHERE status = 1 ORDER BY id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($result as $row) { $i++; ?>
                            <li>
                                <a href="service-show.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="team.php">Team</a></li>
                <li><a class="nav-link scrollto" href="testimony.php">Testimony</a></li>
                <li><a class="nav-link scrollto" href="contact.php">Contact Us</a></li>
            </ul>
            <p class="fa fa-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

<script>
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('fixed-top')) {
      offset += 70
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Header fixed top on scroll
   */
  let selectHeader = select('#header')
  let selectTopbar = select('#topbar')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.add('topbar-scrolled')
        }
      } else {
        selectHeader.classList.remove('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.remove('topbar-scrolled')
        }
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

})()

</script>