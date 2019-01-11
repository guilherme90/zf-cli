# ZF CLI

### Motivation
After a while working with other frameworks, I realized that the cli for Zend 2 is quite precarious. For this reason I am donating my time to improve this and make life easier for the developers!

### Functionalities
- [x] Module with options **Controller** and **Action**
- [x] Create controller
- [x] Create action

### How to use
```bash
$ ./bin/zf-cli
```

After run this command, the output was:

**Welcome to Zend Framework CLI**

See as available options


| Commands          | Description           |
| -------------     | -------------         |
| module:create     | Create new module     |
| module:help       | Displays help         |
| controller:create | Create new Controller |
| controller:help   | Displays help         |

### Tests
```bash
$ composer test
```