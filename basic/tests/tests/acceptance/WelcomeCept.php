

<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('ensure that frontpage works uol');
  $I->amOnPage('/');
  $I->see('Home');
  

#	$I->amOnPage('/login');
	#$I->fillField('username', 'bruno');
	#$I->fillField('password', 'bruno');
	#$I->click('LOGIN');
	#$I->see('Welcome, Bruno!');
?>

