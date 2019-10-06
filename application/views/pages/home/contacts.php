<?php
  $this->load->view('templates/header.php');
  $this->load->view('templates/nav.php');
?>

<main role="main">

  <div class="jumbotron" style="padding: 2rem 1rem; margin-bottom: 0px">
    <div class="container">
      <h1 class="display-3">Контакты</h1>
      <p>Компьютерная академия ШАГ | Киев</p>
    </div>
  </div>

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5081.767288068214!2d30.492516782801058!3d50.443267934544245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc6184e2d09cb9efd!2z0JrQvtC80L_RjNGO0YLQtdGA0L3QsNGPINCQ0LrQsNC00LXQvNC40Y8g0KjQkNCTLCDQmtC40LXQsg!5e0!3m2!1sru!2sua!4v1539116801773"  height="450" frameborder="0" style="width: 100%; border:0" allowfullscreen></iframe>

  <div class="container">

    <div class="row">
      <div class="contacts col">
        <hr>
        <p class="address">01032, Украина, г. Киев,<br />
        ул. Жилянская, 128/28</p>
        <p class="phone"><a href="tel:+380737978820">(073) 797-88-20</a></p>
        <p class="phone"><a href="tel:+380966617707">(096) 661-77-07</a></p>
        <p class="phone"><a href="tel:+380662718000">(066) 271-80-00</a></p>
        <p class="email">office_kiev@itstep.org</p>
        <p><strong>Режим работы:</strong></p>
        <p>&#8211; приемная комиссия<br />
          пн.-пт.: 9:00-19:00;<br />
          сб.: 9:00-15:00<br />
        вс.: выходной</p>
        <p>&#8211; учебная часть<br />
          пн.-чт.: 9:00 &#8211; 20:00<br />
        пт.-вс.:  9:00 &#8211; 19:00</p>
        <p>&#8211; бухгалтерия<br />
        пн.-пт.: 9:00 &#8211; 19:00</p>
      </div>
      <div class="contacts col">
        <hr>
        <table>
          <tbody>
            <tr>
              <td><strong>Корпоративный отдел:</strong></td>
              <td style="text-align: right"><a href="tel:+380445372260">(044) 537-22-60</a> </td>
            </tr>
            <tr>
              <td>
                <p><strong>Учебная часть:</strong></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><strong>Бухгалтерия:</strong></p>
              </td>
              <td style="text-align: right">
                <p><a href="tel:+38(044) 229-85-24">(044) 229-85-24</a></p>
                <p><a href="mailto:metodist_kiev@itstep.org">metodist_kiev@itstep.org</a> (менеджеры<br />учебного процесса)</p>
                <p><a href="tel:+380442298520"> ‎</a></p>
                <p><a href="tel:+380442298520">(044) 229-85-20</a></p>
                <p>buhgalter_kiev@itstep.org</p>
              </td>
            </tr>
            <tr>
              <td><strong>HR-отдел:</strong></td>
              <td style="text-align: right">hr_kiev@itstep.org</td>
            </tr>
            <tr>
              <td><strong>Бухгалтерия:</strong></td>
              <td style="text-align: right">Buhgalter_kiev@itstep.org</td>
            </tr>
            <tr>
              <td> </td>
              <td style="text-align: right"> </td>
            </tr>
            <tr>
              <td> </td>
              <td style="text-align: right"> </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /row -->
    </div>

  </div> <!-- /container -->

</main>

<?php
  $this->load->view('templates/footer.php');
?>