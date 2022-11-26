@extends('layouts.layout')
@section('content')

<div class="create">
    <div class="create__wrapper">
        <p class="create__title">Новая статья</p>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                    {{$error}} 
                    </li>
                @endforeach 
            </ul>
        </div>
        @endif
        <form class="create__form" action="store" method="post">
            @csrf
          <div class="create__block">
            <label for="nameInput" class="create__label">Название</label>
            <input type="text" class="create__input" name="name" id="nameInput">
          </div>
          <div class="create__block">
            <label for="shortDescInput" class="create__label">Описание</label>
            <input type="text" class="create__input" name="shortDesc" id="shortDescInput">
          </div>
          <div class="create__block">
            <label for="dateInput" class="create__label">Дата</label>
            <input type="date" class="create__input" name="date" id="dateInput">
          </div>
          <div class="create__block">
            <label for="areaInput" class="create__label">Добавить в слайдер</label>
            <input class="create__text" name="slider" value="true" type="checkbox" id="checkInput">
          </div>
          <div class="create__block">
            <label for="areaInput" class="create__label">Текст статьи</label>
            <textarea class="create__text-area" name="desc" id="areaInput"></textarea>
          </div>
          
          <div class="create__container">
            <div class="create__toolbar">
              <div class="create__head">
                <input type="text" placeholder="Filename" value="untitled" id="filename">
                <select onchange="fileHandle(this.value); this.selectedIndex=0">
                  <option value="" selected="" hidden="" disabled="">Файл</option>
                  <option value="new">Новый файл</option>
                  <option value="txt">Созранить в txt</option>
                  <option value="pdf">Сохранить в pdf</option>
                </select>
                <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                  <option value="" selected="" hidden="" disabled="">Формат текста</option>
                  <option value="h1">Heading 1</option>
                  <option value="h2">Heading 2</option>
                  <option value="h3">Heading 3</option>
                  <option value="h4">Heading 4</option>
                  <option value="h5">Heading 5</option>
                  <option value="h6">Heading 6</option>
                  <option value="p">Обычный текст</option>
                </select>
                <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                  <option value="" selected="" hidden="" disabled="">Размер текста</option>
                  <option value="1">Очень маленький</option>
                  <option value="2">Маленький</option>
                  <option value="3">Средний</option>
                  <option value="4">Выше среднего</option>
                  <option value="5">Большой</option>
                  <option value="6">Очень большой</option>
                  <option value="7">Огромный</option>
                </select>
                <div class="color">
                  <span>Цвет текста</span>
                  <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                </div>
                <div class="color">
                  <span>Фон текста</span>
                  <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                </div>
              </div>
              <div class="create__bar btn-toolbar">
                <button onclick="formatDoc('undo'); return false;"><i class='create__button-icon bx bx-undo' ></i></button>
                <button onclick="formatDoc('redo'); return false;"><i class='create__button-icon bx bx-redo' ></i></button>
                <button onclick="formatDoc('bold'); return false;"><i class='create__button-icon bx bx-bold'></i></button>
                <button onclick="formatDoc('underline'); return false;"><i class='create__button-icon bx bx-underline' ></i></button>
                <button onclick="formatDoc('italic'); return false;"><i class='create__button-icon bx bx-italic' ></i></button>
                <button onclick="formatDoc('strikeThrough'); return false;"><i class='create__button-icon bx bx-strikethrough' ></i></button>
                <button onclick="formatDoc('justifyLeft'); return false;"><i class='create__button-icon bx bx-align-left' ></i></button>
                <button onclick="formatDoc('justifyCenter'); return false;"><i class='create__button-icon bx bx-align-middle' ></i></button>
                <button onclick="formatDoc('justifyRight'); return false;"><i class='create__button-icon bx bx-align-right' ></i></button>
                <button onclick="formatDoc('justifyFull'); return false;"><i class='create__button-icon bx bx-align-justify' ></i></button>
                <button onclick="formatDoc('insertOrderedList'); return false;"><i class='create__button-icon bx bx-list-ol' ></i></button>
                <button onclick="formatDoc('insertUnorderedList'); return false;"><i class='create__button-icon bx bx-list-ul' ></i></button>
                <button onclick="addLink(); return false;"><i class='create__button-icon bx bx-link' ></i></button>
                <button onclick="formatDoc('unlink'); return false;"><i class='create__button-icon bx bx-unlink' ></i></button>
                <button id="show-code" data-active="false" class="create__button-icon">&lt;/&gt;</button>
              </div>
            </div>
            <div class="editor__content" id="contentEditor" contenteditable="true" spellcheck="false">
              <h1>Заголовок</h1>
              <p>Начало вашего текста...</p>
            </div>
          </div>
          
          <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <script>
            function SubmitContent(){
              document.getElementById("areaInput").value = document.getElementById("contentEditor").innerHTML;
              return true;
            }
            
            function formatDoc(cmd, value=null) {
              if(value) {
                document.execCommand(cmd, false, value);
              } else {
                document.execCommand(cmd);
              }
            }
            
            function addLink() {
              const url = prompt('Insert url');
              formatDoc('createLink', url);
            }
            
            
            
            
            const content = document.getElementById('content');
            
            content.addEventListener('mouseenter', function () {
              const a = content.querySelectorAll('a');
              a.forEach(item=> {
                item.addEventListener('mouseenter', function () {
                  content.setAttribute('contenteditable', false);
                  item.target = '_blank';
                })
                item.addEventListener('mouseleave', function () {
                  content.setAttribute('contenteditable', true);
                })
              })
            })
            
            
            const showCode = document.getElementById('show-code');
            let active = false;
            
            showCode.addEventListener('click', function () {
              showCode.dataset.active = !active;
              active = !active
              if(active) {
                content.textContent = content.innerHTML;
                content.setAttribute('contenteditable', false);
              } else {
                content.innerHTML = content.textContent;
                content.setAttribute('contenteditable', true);
              }
            })
            
            
            
            const filename = document.getElementById('filename');
            
            function fileHandle(value) {
              if(value === 'new') {
                content.innerHTML = '';
                filename.value = 'untitled';
              } else if(value === 'txt') {
                const blob = new Blob([content.innerText])
                const url = URL.createObjectURL(blob)
                const link = document.createElement('a');
                link.href = url;
                link.download = `${filename.value}.txt`;
                link.click();
              } else if(value === 'pdf') {
                html2pdf(content).save(filename.value);
              }
            }
          </script>

          <button onclick="SubmitContent()" type="submit" class="create__button">Опубликовать</button>
        </form>
    </div>
</div>
@endsection