<?php 
    include_once('admheader.php');
    ?>
   
<h1>Novo Imovel</h1>
<form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Preço</label>
    <input type="number" class="form-control" id="txtPreco" placeholder="R$123.000,000">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Condominio</label>
    <input type="number" class="form-control" id="txtCondominio" placeholder="R$123.000,000">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Área</label>
    <input type="number" class="form-control" id="txtArea" placeholder="100">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Quartos</label>
    <select class="form-control" id="ddrQuartos">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Banheiros</label>
    <select  class="form-control" id="ddrBanheiros">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Vagas</label>
    <select  class="form-control" id="ddrVagas">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descrição</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Fotos</label><br>
    <input type='file' onchange="readURL(this);" id="img1" style="display:none;"/>
<img id="blah" class="imgUp" src="../img/newpic.png" alt="your image" onclick="setFile()" />
<img id="blah" class="imgUp" src="../img/newpic.png" alt="your image" onclick="setFile()" />
  </div>
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
<script>
    function setFile(){
        $('#img1').click();
    }
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        </script>
<?php 
 include_once('../footer.php');
 ?>
 