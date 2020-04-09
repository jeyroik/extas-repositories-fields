![tests](https://github.com/jeyroik/extas-repositories-fields/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-repositories-fields/coverage.svg?branch=master)

# Описание

Пакет для создания адапторов полей для Extas.

С помощью адапторов полей можно создавать обработчики, которые будут заменять или обогащать значения полей при создании/обновлении extas-совместимых сущностей.

# Использование

1. Создать плагин.
2. В плагине реализовать адапторы.

```php
class MyAdaptorPlugin extends \extas\components\repositories\FieldAdaptorPlugin
{
    protected function getMarkers()
    {
        return [
            new class () extends \extas\components\repositories\FieldAdaptor {
                public function isApplicable(string $value): bool
                {
                    // Проверяем подходит ли значение поля для адаптации.
                    return $value == 'my';
                }

                public function apply(string $value)
                {
                    return 'world';
                }
            }
        ];
    }
}
```

3. Подключить плагин к интересуемой стадии.

В `extas.json`:

```json
{
    "plugins": [
        {
            "class": "MyAdaptorPlugin",
            "stage": "extas.<entity>.create.before"
        }
    ]
}
```

В качестве примера можно посмотреть:

- [extas-repositories-fields-sha1](https://github.com/jeyroik/extas-repositories-fields-sha1) позволяет автоматически шифровать значение с помощью sha1.
- [extas-repositories-uuid-fields](https://github.com/jeyroik/extas-repositories-uuid-fields) позволяет генерировать uuid-строки для значения полей.