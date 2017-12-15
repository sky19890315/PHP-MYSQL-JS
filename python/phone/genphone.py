import xlrd
import xlwt
import random
import string


file = xlrd.open_workbook('baijiaxing.xls')
table = file.sheet_by_name(u'Sheet1')
n = table.nrows

last_names = []


for i in range(n):
    last_names.extend(table.row_values(i))

hanzi = '的一是在不了有和人这中大为上个国我以要他时来用们生到作地于' \
        '出就分对成会可主发年动同工也能下过子说产种面而方后多定行学' \
        '法所民得经十三之进着等部度家电力里如水化高自二理起小物现实' \
        '加量都两体制机当使点从业本去把性好应开它合还因由其些然前外' \
        '天政四日那社义事平形相全表间样与关各重新线内数正心反你明看' \
        '原又么利比或但质气第向道命此变条只没结解问意建月公无系军很' \
        '情者最立代想已通并提直题党程展五果料象员革位入常文总次品式' \
        '活设及管特件长求老头基资边流路级少图山统接知较将组见计别她' \
        '手角期根论运农指几九区强放决西被干做必战先回则任取据处队南' \
        '给色光门即保治北造百规热领七海口东导器压志世金增争济阶油思' \
        '术极交受联什认六共权收证改清己美再采转更单风切打白教速花带' \
        '安场身车例真务具万每目至达走积示议声报斗完类八离华名确才科' \
        '张信马节话米整空元况今集温传土许步群广石记需段研界拉林律叫' \
        '且究观越织装影算低持音众书布复容儿须际商非验连断深难近矿千' \
        '周委素技备半办青省列习响约支般史感劳便团往酸历市克何除消构' \
        '府称太准精值号率族维划选标写存候毛亲快效斯院查江型眼王按格' \
        '养易置派层片始却专状育厂京识适属圆包火住调满县局照参红细引' \
        '听该铁价严七久梦'


hanzis = list(hanzi)


prephone = ['130', '131', '132', '155', '156', '186', '185', '176',
         '134','135','136','137','138','139','150','151','152',
         '157','158','159','182','183','184','188','187','147',
         '178','133','153','180','181','189','177']

midphone = ['0','1','2','3','4','5','6','7','8','9']

# lastphone = ['0','1','2','3','4','5','6','7','8','9']


# wfile = xlwt.Workbook('phone.xls')
wfile = xlwt.Workbook()

wtable = wfile.add_sheet('Sheet1', cell_overwrite_ok=True)

for i in range(10000):
    ln = random.randint(1,2)
    if ln == 1:
        name = random.choice(last_names) + random.choice(hanzis)
    else:
        name = random.choice(last_names) + random.choice(hanzis) + random.choice(hanzis)
    phone = random.choice(prephone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone) + random.choice(midphone)
    wtable.write(i,0,name)
    wtable.write(i,1,phone)


wfile.save('phone2.xls')






