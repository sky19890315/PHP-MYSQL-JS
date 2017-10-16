/*
   +----------------------------------------------------------------------+
   | PHP Version 7                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2017 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Andi Gutmans <andi@zend.com>                                |
   |          Zeev Suraski <zeev@zend.com>                                |
   +----------------------------------------------------------------------+
 */

/* $Id$ */

#ifndef PHP_H /*如果没有被宏定义,则进行定义 */
#define PHP_H // 定义

#ifdef HAVE_DMALLOC // 已定义
/*
dmalloc是一种用于检查C/C++内存泄露(leak)的工具，即检查是否存在直到程序运行结束还没有释放的内存，并且能够精确指出在哪个源文件的第几行。
*/
#include <dmalloc.h> // 引入标准库
#endif // 结束判断
// 定义 api 版本
#define PHP_API_VERSION 20170718
#define PHP_HAVE_STREAMS
#define YYDEBUG 0
#define PHP_DEFAULT_CHARSET "UTF-8"// 字符集
/*
引入 php 主文件
*/
#include "php_version.h"
#include "zend.h"
#include "zend_sort.h"
#include "php_compat.h"

#include "zend_API.h"

#undef sprintf //取消在先前程序中对预处理器的定义。
#define sprintf php_sprintf // 定义为 php 标准输出

/* Operating system family defintion */
#ifdef PHP_WIN32// 判断操作系统
# define PHP_OS_FAMILY			"Windows"
#elif defined(BSD) || defined(__DragonFly__) || defined(__FreeBSD__) || defined(__NetBSD__) || defined(__OpenBSD__)
# define PHP_OS_FAMILY			"BSD"
#elif defined(__APPLE__) || defined(__MACH__)
# define PHP_OS_FAMILY			"Darwin"
#elif defined(__sun__)
# define PHP_OS_FAMILY			"Solaris"
#elif defined(__linux__)
# define PHP_OS_FAMILY			"Linux"
#else
# define PHP_OS_FAMILY			"Unknown"
#endif

/* PHP's DEBUG value must match Zend's ZEND_DEBUG value */
/* phpdebug 必须匹配 zend 虚拟机的 debug 设定
所以先取消掉之前的定义 专门为 php 定义 zenddebug*/
#undef PHP_DEBUG
#define PHP_DEBUG ZEND_DEBUG

#ifdef PHP_WIN32
#	include "tsrm_win32.h"
#	ifdef PHP_EXPORTS
#		define PHPAPI __declspec(dllexport)
#	else
#		define PHPAPI __declspec(dllimport)
#	endif
#	define PHP_DIR_SEPARATOR '\\'
#	define PHP_EOL "\r\n"
#else
#	if defined(__GNUC__) && __GNUC__ >= 4
#		define PHPAPI __attribute__ ((visibility("default")))
#	else
#		define PHPAPI
#	endif
#	define THREAD_LS
#	define PHP_DIR_SEPARATOR '/'
#	define PHP_EOL "\n"
#endif

/* Windows specific defines */
#ifdef PHP_WIN32
# define PHP_PROG_SENDMAIL		"Built in mailer"
# define HAVE_DECLARED_TIMEZONE
# define WIN32_LEAN_AND_MEAN
# define NOOPENFILE
// 引入相关的库 包括 io 标准库等
# include <io.h>
/*
malloc函数是一种分配长度为num_bytes字节的内存块的函数，可以向系统申请分配指定size个字节的内存空间。malloc的全称是memory allocation，中文叫动态内存分配，当无法知道内存具体位置的时候，想要绑定真正的内存空间，就需要用到动态的分配内存。
返回类型是 void* 类型。void* 表示未确定类型的指针。C,C++规定，void* 类型可以通过类型转换强制转换为任何其它类型的指针。
*/
# include <malloc.h>
/*
direct.h是由Microsoft Windows提供的C / C ++ 头文件，其中包含用于操作文件系统目录的功能。一些POSIX功能类似的东西在unistd.h。
*/
# include <direct.h>
// 标准公共类库
# include <stdlib.h>
# include <stdio.h>
/*
stdarg.h是C语言中C标准库的头文件，stdarg是由standard(标准) arguments(参数)简化而来，主要目的为让函数能够接收不定量参数。[1] C++的cstdarg头文件中也提供这样的机能；虽然与C的头文件是兼容的，但是也有冲突存在。
不定参数函数(Variadic functions)是stdarg.h内容典型的应用，虽然也可以使用在其他由不定参数函数调用的函数(
*/
# include <stdarg.h>
/*
sys/types.h，在应用程序源文件中包含 <sys/types.h> 以访问 _LP64 和 _ILP32 的定义。所有这些类型在 ILP32 编译环境中保持为 32 位值，并会在 LP64 编译环境中增长为 64 位值。
*/
# include <sys/types.h>
/*
process.h 是包含用于和宏指令的作用声明与螺纹和过程一起使用的C标头文件。 标头文件的作用是由二者之一定义的 ANSI/ISO C 标准或 POSIX、多数C编译器 DOS, 窗口3.1x, Win32, OS/2Novell NetWare或 DOS职能在他们的C程序库里。多线程相关的时候就需要include <process.h>提供了两个对多线程进行支持的函数，即线程的创建和终结没有对线程挂起和恢复进行操作的函数，通常，这两项功能使用win32 api完成。
*/
# include <process.h>
/*
#define 是 C 指令，用于为各种数据类型定义别名，与 typedef 类似，但是它们有以下几点不同：
typedef 仅限于为类型定义符号名称，#define 不仅可以为类型定义别名，也能为数值定义别名，比如您可以定义 1 为 ONE。
typedef 是由编译器执行解释的，#define 语句是由预编译器进行处理的。
*/
typedef int uid_t;
typedef int gid_t;
typedef char * caddr_t;
typedef unsigned int uint;
typedef unsigned long ulong;
typedef int pid_t;

# ifndef PHP_DEBUG
#  ifdef inline
#   undef inline
#  endif
#  define inline		__inline
# endif

# define M_TWOPI        (M_PI * 2.0)
# define off_t			_off_t

# define lstat(x, y)	php_sys_lstat(x, y)
# define chdir(path)	_chdir(path)
# define mkdir(a, b)	_mkdir(a)
# define rmdir(a)		_rmdir(a)
# define getpid			_getpid
# define php_sleep(t)	SleepEx(t*1000, TRUE)

# ifndef getcwd
#  define getcwd(a, b)	_getcwd(a, b)
# endif
#endif

#if HAVE_ASSERT_H
#if PHP_DEBUG
#undef NDEBUG
#else
#ifndef NDEBUG
#define NDEBUG
#endif
#endif
#include <assert.h>
#else /* HAVE_ASSERT_H */
#define assert(expr) ((void) (0))
#endif /* HAVE_ASSERT_H */

#define APACHE 0

#if HAVE_UNIX_H
#include <unix.h>
#endif

#if HAVE_ALLOCA_H
#include <alloca.h>
#endif

#if HAVE_BUILD_DEFS_H
#include <build-defs.h>
#endif

/*
 * This is a fast version of strlcpy which should be used, if you
 * know the size of the destination buffer and if you know
 * the length of the source string.
 *
 * size is the allocated number of bytes of dst
 * src_size is the number of bytes excluding the NUL of src
 */

#define PHP_STRLCPY(dst, src, size, src_size)	\
	{											\
		size_t php_str_len;						\
												\
		if (src_size >= size)					\
			php_str_len = size - 1;				\
		else									\
			php_str_len = src_size;				\
		memcpy(dst, src, php_str_len);			\
		dst[php_str_len] = '\0';				\
	}

#ifndef HAVE_STRLCPY
BEGIN_EXTERN_C()
PHPAPI size_t php_strlcpy(char *dst, const char *src, size_t siz);
END_EXTERN_C()
#undef strlcpy
#define strlcpy php_strlcpy
#define HAVE_STRLCPY 1
#define USE_STRLCPY_PHP_IMPL 1
#endif

#ifndef HAVE_STRLCAT
BEGIN_EXTERN_C()
PHPAPI size_t php_strlcat(char *dst, const char *src, size_t siz);
END_EXTERN_C()
#undef strlcat
#define strlcat php_strlcat
#define HAVE_STRLCAT 1
#define USE_STRLCAT_PHP_IMPL 1
#endif

#ifndef HAVE_EXPLICIT_BZERO
BEGIN_EXTERN_C()
PHPAPI void php_explicit_bzero(void *dst, size_t siz);
END_EXTERN_C()
#undef explicit_bzero
#define explicit_bzero php_explicit_bzero
#endif

#ifndef HAVE_STRTOK_R
BEGIN_EXTERN_C()
char *strtok_r(char *s, const char *delim, char **last);
END_EXTERN_C()
#endif

#ifndef HAVE_SOCKLEN_T
# ifdef PHP_WIN32
typedef int socklen_t;
# else
typedef unsigned int socklen_t;
# endif
#endif

#define CREATE_MUTEX(a, b)
#define SET_MUTEX(a)
#define FREE_MUTEX(a)

/*
 * Then the ODBC support can use both iodbc and Solid,
 * uncomment this.
 * #define HAVE_ODBC (HAVE_IODBC|HAVE_SOLID)
 */

#include <stdlib.h>
#include <ctype.h>
#if HAVE_UNISTD_H
#include <unistd.h>
#endif
#if HAVE_STDARG_H
#include <stdarg.h>
#else
# if HAVE_SYS_VARARGS_H
# include <sys/varargs.h>
# endif
#endif

#include "php_stdint.h"

#include "zend_hash.h"
#include "zend_alloc.h"
#include "zend_stack.h"

#if STDC_HEADERS
# include <string.h>
#else
# ifndef HAVE_MEMCPY
#  define memcpy(d, s, n)	bcopy((s), (d), (n))
# endif
# ifndef HAVE_MEMMOVE
#  define memmove(d, s, n)	bcopy ((s), (d), (n))
# endif
#endif

#ifndef HAVE_STRERROR
char *strerror(int);
#endif

#if HAVE_PWD_H
# ifdef PHP_WIN32
#include "win32/param.h"
# else
#include <pwd.h>
#include <sys/param.h>
# endif
#endif

#if HAVE_LIMITS_H
#include <limits.h>
#endif

#ifndef LONG_MAX
#define LONG_MAX 2147483647L
#endif

#ifndef LONG_MIN
#define LONG_MIN (- LONG_MAX - 1)
#endif

#ifndef INT_MAX
#define INT_MAX 2147483647
#endif

#ifndef INT_MIN
#define INT_MIN (- INT_MAX - 1)
#endif

/* double limits */
#include <float.h>
#if defined(DBL_MANT_DIG) && defined(DBL_MIN_EXP)
#define PHP_DOUBLE_MAX_LENGTH (3 + DBL_MANT_DIG - DBL_MIN_EXP)
#else
#define PHP_DOUBLE_MAX_LENGTH 1080
#endif

#define PHP_GCC_VERSION ZEND_GCC_VERSION
#define PHP_ATTRIBUTE_MALLOC ZEND_ATTRIBUTE_MALLOC
#define PHP_ATTRIBUTE_FORMAT ZEND_ATTRIBUTE_FORMAT

BEGIN_EXTERN_C()
#include "snprintf.h"
END_EXTERN_C()
#include "spprintf.h"

#define EXEC_INPUT_BUF 4096

#define PHP_MIME_TYPE "application/x-httpd-php"

/* macros */
#define STR_PRINT(str)	((str)?(str):"")

#ifndef MAXPATHLEN
# ifdef PHP_WIN32
#  include "win32/ioutil.h"
#  define MAXPATHLEN PHP_WIN32_IOUTIL_MAXPATHLEN
# elif PATH_MAX
#  define MAXPATHLEN PATH_MAX
# elif defined(MAX_PATH)
#  define MAXPATHLEN MAX_PATH
# else
#  define MAXPATHLEN 256    /* Should be safe for any weird systems that do not define it */
# endif
#endif

#define php_ignore_value(x) ZEND_IGNORE_VALUE(x)

/* global variables */
#if !defined(PHP_WIN32)
#define PHP_SLEEP_NON_VOID
#define php_sleep sleep
extern char **environ;
#endif	/* !defined(PHP_WIN32) */

#ifdef PHP_PWRITE_64
ssize_t pwrite(int, void *, size_t, off64_t);
#endif

#ifdef PHP_PREAD_64
ssize_t pread(int, void *, size_t, off64_t);
#endif

BEGIN_EXTERN_C()
void phperror(char *error);
PHPAPI size_t php_write(void *buf, size_t size);
PHPAPI size_t php_printf(const char *format, ...) PHP_ATTRIBUTE_FORMAT(printf, 1,
		2);
PHPAPI int php_get_module_initialized(void);
#ifdef HAVE_SYSLOG_H
#include "php_syslog.h"
#define php_log_err(msg) php_log_err_with_severity(msg, LOG_NOTICE)
#else
#define php_log_err(msg) php_log_err_with_severity(msg, 5)
#endif
PHPAPI ZEND_COLD void php_log_err_with_severity(char *log_message, int syslog_type_int);
int Debug(char *format, ...) PHP_ATTRIBUTE_FORMAT(printf, 1, 2);
int cfgparse(void);
END_EXTERN_C()

#define php_error zend_error
#define error_handling_t zend_error_handling_t

BEGIN_EXTERN_C()
static inline ZEND_ATTRIBUTE_DEPRECATED void php_set_error_handling(error_handling_t error_handling, zend_class_entry *exception_class)
{
	zend_replace_error_handling(error_handling, exception_class, NULL);
}
static inline ZEND_ATTRIBUTE_DEPRECATED void php_std_error_handling() {}

PHPAPI ZEND_COLD void php_verror(const char *docref, const char *params, int type, const char *format, va_list args) PHP_ATTRIBUTE_FORMAT(printf, 4, 0);

/* PHPAPI void php_error(int type, const char *format, ...); */
PHPAPI ZEND_COLD void php_error_docref0(const char *docref, int type, const char *format, ...)
	PHP_ATTRIBUTE_FORMAT(printf, 3, 4);
PHPAPI ZEND_COLD void php_error_docref1(const char *docref, const char *param1, int type, const char *format, ...)
	PHP_ATTRIBUTE_FORMAT(printf, 4, 5);
PHPAPI ZEND_COLD void php_error_docref2(const char *docref, const char *param1, const char *param2, int type, const char *format, ...)
	PHP_ATTRIBUTE_FORMAT(printf, 5, 6);
#ifdef PHP_WIN32
PHPAPI ZEND_COLD void php_win32_docref2_from_error(DWORD error, const char *param1, const char *param2);
#endif
END_EXTERN_C()

#define php_error_docref php_error_docref0

#define zenderror phperror
#define zendlex phplex

#define phpparse zendparse
#define phprestart zendrestart
#define phpin zendin

#define php_memnstr zend_memnstr

/* functions */
BEGIN_EXTERN_C()
PHPAPI extern int (*php_register_internal_extensions_func)(void);
PHPAPI int php_register_internal_extensions(void);
PHPAPI int php_mergesort(void *base, size_t nmemb, size_t size, int (*cmp)(const void *, const void *));
PHPAPI void php_register_pre_request_shutdown(void (*func)(void *), void *userdata);
PHPAPI void php_com_initialize(void);
PHPAPI char *php_get_current_user(void);
END_EXTERN_C()

/* PHP-named Zend macro wrappers */
#define PHP_FN					ZEND_FN
#define PHP_MN					ZEND_MN
#define PHP_NAMED_FUNCTION		ZEND_NAMED_FUNCTION
#define PHP_FUNCTION			ZEND_FUNCTION
#define PHP_METHOD  			ZEND_METHOD

#define PHP_RAW_NAMED_FE ZEND_RAW_NAMED_FE
#define PHP_NAMED_FE	ZEND_NAMED_FE
#define PHP_FE			ZEND_FE
#define PHP_DEP_FE      ZEND_DEP_FE
#define PHP_FALIAS		ZEND_FALIAS
#define PHP_DEP_FALIAS	ZEND_DEP_FALIAS
#define PHP_ME          ZEND_ME
#define PHP_MALIAS      ZEND_MALIAS
#define PHP_ABSTRACT_ME ZEND_ABSTRACT_ME
#define PHP_ME_MAPPING  ZEND_ME_MAPPING
#define PHP_FE_END      ZEND_FE_END

#define PHP_MODULE_STARTUP_N	ZEND_MODULE_STARTUP_N
#define PHP_MODULE_SHUTDOWN_N	ZEND_MODULE_SHUTDOWN_N
#define PHP_MODULE_ACTIVATE_N	ZEND_MODULE_ACTIVATE_N
#define PHP_MODULE_DEACTIVATE_N	ZEND_MODULE_DEACTIVATE_N
#define PHP_MODULE_INFO_N		ZEND_MODULE_INFO_N

#define PHP_MODULE_STARTUP_D	ZEND_MODULE_STARTUP_D
#define PHP_MODULE_SHUTDOWN_D	ZEND_MODULE_SHUTDOWN_D
#define PHP_MODULE_ACTIVATE_D	ZEND_MODULE_ACTIVATE_D
#define PHP_MODULE_DEACTIVATE_D	ZEND_MODULE_DEACTIVATE_D
#define PHP_MODULE_INFO_D		ZEND_MODULE_INFO_D

/* Compatibility macros */
#define PHP_MINIT		ZEND_MODULE_STARTUP_N
#define PHP_MSHUTDOWN	ZEND_MODULE_SHUTDOWN_N
#define PHP_RINIT		ZEND_MODULE_ACTIVATE_N
#define PHP_RSHUTDOWN	ZEND_MODULE_DEACTIVATE_N
#define PHP_MINFO		ZEND_MODULE_INFO_N
#define PHP_GINIT		ZEND_GINIT
#define PHP_GSHUTDOWN	ZEND_GSHUTDOWN

#define PHP_MINIT_FUNCTION		ZEND_MODULE_STARTUP_D
#define PHP_MSHUTDOWN_FUNCTION	ZEND_MODULE_SHUTDOWN_D
#define PHP_RINIT_FUNCTION		ZEND_MODULE_ACTIVATE_D
#define PHP_RSHUTDOWN_FUNCTION	ZEND_MODULE_DEACTIVATE_D
#define PHP_MINFO_FUNCTION		ZEND_MODULE_INFO_D
#define PHP_GINIT_FUNCTION		ZEND_GINIT_FUNCTION
#define PHP_GSHUTDOWN_FUNCTION	ZEND_GSHUTDOWN_FUNCTION

#define PHP_MODULE_GLOBALS		ZEND_MODULE_GLOBALS


/* Output support */
#include "main/php_output.h"


#include "php_streams.h"
#include "php_memory_streams.h"
#include "fopen_wrappers.h"


/* Virtual current working directory support */
#include "zend_virtual_cwd.h"

#include "zend_constants.h"

/* connection status states */
#define PHP_CONNECTION_NORMAL  0
#define PHP_CONNECTION_ABORTED 1
#define PHP_CONNECTION_TIMEOUT 2

#include "php_reentrancy.h"

/* Finding offsets of elements within structures.
 * Taken from the Apache code, which in turn, was taken from X code...
 */

#ifndef XtOffset
#if defined(CRAY) || (defined(__arm) && !(defined(LINUX) || defined(__riscos__)))
#ifdef __STDC__
#define XtOffset(p_type, field) _Offsetof(p_type, field)
#else
#ifdef CRAY2
#define XtOffset(p_type, field) \
    (sizeof(int)*((unsigned int)&(((p_type)NULL)->field)))

#else /* !CRAY2 */

#define XtOffset(p_type, field) ((unsigned int)&(((p_type)NULL)->field))

#endif /* !CRAY2 */
#endif /* __STDC__ */
#else /* ! (CRAY || __arm) */

#define XtOffset(p_type, field) \
    ((zend_long) (((char *) (&(((p_type)NULL)->field))) - ((char *) NULL)))

#endif /* !CRAY */
#endif /* ! XtOffset */

#ifndef XtOffsetOf
#ifdef offsetof
#define XtOffsetOf(s_type, field) offsetof(s_type, field)
#else
#define XtOffsetOf(s_type, field) XtOffset(s_type*, field)
#endif
#endif /* !XtOffsetOf */

#endif

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: sw=4 ts=4 fdm=marker
 * vim<600: sw=4 ts=4
 */
