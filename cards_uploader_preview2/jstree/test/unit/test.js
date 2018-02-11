<<<<<<< HEAD
test('basic test', function() {
  expect(1);
  ok(true, 'this had better work.');
});


test('can access the DOM', function() {
  expect(1);
  var fixture = document.getElementById('qunit-fixture');
  equal(fixture.innerText || fixture.textContent, 'this had better work.', 'should be able to access the DOM.');
=======
test('basic test', function() {
  expect(1);
  ok(true, 'this had better work.');
});


test('can access the DOM', function() {
  expect(1);
  var fixture = document.getElementById('qunit-fixture');
  equal(fixture.innerText || fixture.textContent, 'this had better work.', 'should be able to access the DOM.');
>>>>>>> d9e51a6aff59411e043abff15fcc3b3210a42892
});