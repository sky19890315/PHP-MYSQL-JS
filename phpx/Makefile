PHP_INCLUDE = `php-config --includes`
PHP_LIBS = `php-config --libs`
PHP_LDFLAGS = `php-config --ldflags`
PHP_INCLUDE_DIR = `php-config --include-dir`
PHP_EXTENSION_DIR = `php-config --extension-dir`

test.so: test.cc
	c++ -undefined dynamic_lookup -DHAVE_CONFIG_H -g -o test.so -O0 -fPIC -shared test.cc -std=c++11 ${PHP_INCLUDE} -I${PHP_INCLUDE_DIR} -lphpx

install: test.so
	cp test.so ${PHP_EXTENSION_DIR}/
clean:
	rm *.so
