import wx


class MainWindow(wx.Frame):
    def __init__(self, parent, title):
        wx.Frame.__init__(self, parent, title=title, size=(250, 250))
        self.control = wx.TextCtrl(self, style=wx.TE_MULTILINE)

        self.setupMenuBar()
        self.Show(True)

    def setupMenuBar(self):
        self.CreateStatusBar()

        menubar = wx.MenuBar()
        menufile = wx.Menu()

        menuabout = menufile.Append(wx.ID_ABOUT, '&About', 'about this shit')
        menuexit = menufile.Append(wx.ID_EXIT, '&Exit', 'end program')

        menubar.Append(menufile, '&File')

        self.Bind(wx.EVT_MENU, self.onAbout, menuabout)
        self.Bind(wx.EVT_MENU, self.onExit, menuexit)

        self.SetMenuBar(menubar)

    def onAbout(self, event):
        dog = wx.MessageDialog(self, 'This app is for text', 'About my test app', wx.OK)
        dog.ShowModal()
        dog.Destroy()

    def onExit(self, event):
        self.Close(True)


app = wx.App(False)
frame = MainWindow(None, 'smail editor')
app.MainLoop()


























