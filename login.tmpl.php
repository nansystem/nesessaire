<?php require_once('headerLogin.php') ?>
<section class="contentLogin">
  <div class="g720 alpha">
    <h1>ログイン/会員登録</h1>
    <div class="contentRadioTab">
      <label class="radio-inline" for="contentRadioLogin">
        <input id="contentRadioLogin" name="contentRadio" value="loginTab" <?php if( isset($_POST['action']) && $_POST['action'] === 'login' || $_SERVER['REQUEST_METHOD'] === 'GET') echo 'checked' ?> type="radio" data-target="#contentLoginTab">ログイン
      </label>
      <label class="radio-inline" for="contentRadioRegister">
        <input id="contentRadioRegister" name="contentRadio" value="registerTab" <?php if( isset($_POST['action']) && $_POST['action'] === 'register' ) echo 'checked' ?> type="radio" data-target="#contentRegisterTab">初めて利用する
      </label>
    </div>
    <div class="tab-content">
        <div id="contentLoginTab" class="tab-pane active" >
          <p>会員登録時に入力したメールアドレスとパスワードを入力し、<br>
          ログインボタンをクリックしてください</p>
          <form id="contentLoginTabForm" action="" method="post">
            <input type="hidden" name="action" value="login" >
            <?php if( isset($_GET['redirect']) ): ?>
            <input type="hidden" name="redirect" value="<?= h($_GET['redirect']) ?>" >
            <?php endif ?>
            <div class="contentLoginTabFormInput">          
              <?php //メールアドレスのバリデーションメッセージ
              if( !empty($errors['validatePassword']) ){
                echo "<div class='error' >{$errors['validatePassword']}</div>";
              } ?>
              <div class="form-group">
                <label for="email">メールアドレス</label>     
                <input type="text" name="email" placeholder="メールアドレス" value="<?php v('email') ?>" >
                <?php //メールアドレスのバリデーションメッセージ
                if( !empty($errors['emailEmpty']) ){
                  echo "<div class='error' >{$errors['emailEmpty']}</div>";
                } elseif( !empty($errors['emailValid']) ) {
                  echo "<div class='error' >{$errors['emailValid']}</div>";
                } elseif( !empty($errors['emailNotExists']) ) {
                  echo "<div class='error' >{$errors['emailNotExists']}</div>";
                } ?>
              </div><!-- /form-group -->
              <div class="form-group">
                <label for="password">パスワード</label>     
                <input type="password" name="password" placeholder="パスワード" >
                <?php //メールアドレスのバリデーションメッセージ
                if( !empty($errors['passwordEmpty']) ){
                  echo "<div class='error' >{$errors['passwordEmpty']}</div>";
                } ?>
              </div><!-- /form-group -->
            </div><!-- /contentLoginTabFormInput -->
            <input class="btn btn-primary" type="submit" value="ログイン">

          </form>
        </div>

        <div id="contentRegisterTab" class="tab-pane" >
          <p>メールアドレスとパスワードをご入力いただき、<br>
          会員登録をおこなってください。</p>
          <form class="form" action="" method="post">
            <input type="hidden" name="action" value="register" >
            <?php if( isset($_GET['redirect']) ): ?>
            <input type="hidden" name="redirect" value="<?= h($_GET['redirect']) ?>" >
            <?php endif ?>
            <div class="contentRegisterTabFormInput">
              <div class="form-group">
                <label for="email">メールアドレス</label>     
                <input type="text" name="email" placeholder="メールアドレス" value="<?php v('email') ?>" >
                <?php // メールアドレスのバリデーションメッセージ
                if( !empty($errors['emailEmpty']) ){
                  echo "<div class='error' >{$errors['emailEmpty']}</div>";
                } elseif( !empty($errors['emailValid']) ) {
                  echo "<div class='error' >{$errors['emailValid']}</div>";
                } elseif( !empty($errors['emailExists']) ){
                  echo "<div class='error' >{$errors['emailExists']}</div>";
                } ?>
              </div><!-- /form-group -->

              <div class="form-group">
                <label for="password">パスワード</label>     
                <input type="password" name="password" placeholder="パスワード" >
                <?php  // パスワードのバリデーションメッセージ
                  if( !empty($errors['passwordEmpty']) ){
                    echo "<div class='error' >{$errors['passwordEmpty']}</div>";
                  } elseif( !empty($errors['passwordMin']) ) {
                    echo "<div class='error' >{$errors['passwordMin']}</div>";
                  } elseif( !empty($errors['passwordMax']) ){
                    echo "<div class='error' >{$errors['passwordMax']}</div>";
                  } elseif( !empty($errors['passwordMixedAlphanumeric']) ){
                    echo "<div class='error' >{$errors['passwordMixedAlphanumeric']}</div>";
                  } ?>
              </div><!-- /form-group -->

              <h2>利用規約</h2>
              <div class="contentRegisterTabFormInputTermOfUse">
                <p>＜nesessaire利用規約＞</p>
                <p>1. 株式会社＜nesessaire（以下、「当社」といいます。）は、当社が新しく開始するサービス（以下、個別に「各サービス」といいます。）及び共通サービスの利用規約（以下、「本規約」といいます。）を以下の通り定めます。</p>
                <p>2. 各サービスを利用される場合は、各サービスに関する利用規約のみが適用となりますので、その場合は当社が別途定める各サービスに関する利用規約にそれぞれ従うものとします。</p>
                <p>3. 会員（＜共通サービス利用規約＞第4条で定義します。）は、本規約の付則「個人情報の取扱いに関する同意条項」に同意した上で、本サービスを利用するものとします。</p>
              </div><!-- /contentRegisterTabFormInputTermOfUse -->
              <p class="contentRegisterTabFormInputTermOfUseArea">
              <div class="checkbox">
                <label for="termOfUse">
                  <input id="termOfUse" name="termOfUse" type="checkbox" checked>利用規約に同意する
                </label>
                </div><!-- /checkbox -->
              </p>
            </div><!-- /contentRegisterTabFormInput -->
            <input class="btn btn-primary" type="submit" value="アカウントを登録する">
          </form>
        </div>
    </div><!-- tab-content -->
  </div><!-- /g720 -->
</section><!-- contentLogin -->

<script>
$('input[name="contentRadio"]').click(function () {
    $(this).tab('show');
});
</script>

<?php if( isset($_POST['action']) && $_POST['action'] === 'register' ) : ?>
<script>
$('#contentRadioRegister').attr("checked", true ).tab('show');
</script>
<?php endif ?>


<?php require_once('footerLogin.php') ?>
