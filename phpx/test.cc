#include <phpx.h>
using namespace std;
using namespace php;

PHPX_FUNCTION(cpp_test);

PHPX_EXTENSION()
{
    Extension *ext = new Extension("test", "0.0.1");
    ext->registerFunction(PHPX_FN(cpp_test));
    return ext;
}

PHPX_FUNCTION(cpp_test)
{
    long n = args[1].toInt();
    Array _array(retval);

    for(int i = 0; i < n; i++)
    {
        _array.append(args[0]);
    }

}



