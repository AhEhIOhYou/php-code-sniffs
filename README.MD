1. В коде if (!empty($arResult)) просить заменить на if (!$arResult)

2. Ругаться на вызов метода GetNextElement

![Image alt](https://github.com/AhEhIOhYou/php-code-sniffs/blob/main/screenshots/1.png)

3. В отдельном стандарте "dumpFunction" проверить, что во всех функциях, объявленных в текущем файле, любой вывод обернут в if, проверяющий условие $USER->GetID() == 1

![Image alt](https://github.com/AhEhIOhYou/php-code-sniffs/blob/main/screenshots/2.png)

4. Объявления массивов через Array() и array() ругать, нужно использовать синтаксис []

![Image alt](https://github.com/AhEhIOhYou/php-code-sniffs/blob/main/screenshots/3.png)

5. В отдельном стандарте "OldOrmClass": метод Add должен быть динамическим, содержать использование глобальной переменной $DB и вызов $DB->Add()
6. В отдельном стандарте "OldOrmClass": метод Update должен быть динамическим, содержать использование глобальной переменной $DB и вызов $DB->PrepareUpdate(), $DB->Query

![Image alt](https://github.com/AhEhIOhYou/php-code-sniffs/blob/main/screenshots/4.png)
