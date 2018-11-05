unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ComCtrls;

type
  TForm1 = class(TForm)
    PageControl1: TPageControl;
    TabSheet1: TTabSheet;
    GroupBox1: TGroupBox;
    Edit1: TEdit;
    Label1: TLabel;
    Edit2: TEdit;
    Label2: TLabel;
    Edit3: TEdit;
    Label3: TLabel;
    GroupBox2: TGroupBox;
    Memo1: TMemo;
    GroupBox3: TGroupBox;
    Button1: TButton;
    Memo2: TMemo;
    ProgressBar1: TProgressBar;
    TabSheet2: TTabSheet;
    GroupBox4: TGroupBox;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Edit4: TEdit;
    Edit5: TEdit;
    Edit6: TEdit;
    GroupBox5: TGroupBox;
    Memo3: TMemo;
    GroupBox6: TGroupBox;
    Button2: TButton;
    Memo4: TMemo;
    ProgressBar2: TProgressBar;
    procedure Button1Click(Sender: TObject);
    function getx(w,h:integer):integer;
    function gety(w,h:integer):integer;
    procedure Button2Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

{$R *.dfm}

procedure TForm1.Button1Click(Sender: TObject);
var i,j:integer;
    s:string;
    w,h:integer;
    summ:string;
begin
memo2.Lines.Clear;
w:=strtointdef(edit1.text,92) div 2;
h:=strtointdef(edit2.text,48) div 2;
ProgressBar1.Position:=0;
ProgressBar1.Max:=sqr(strtointdef(edit3.Text,7));
summ:='';
for i:=0 to strtointdef(edit3.Text,7)-1 do
  for j:=0 to strtointdef(edit3.Text,7)-1 do
    begin
    s:=memo1.text;
    s:=StringReplace(s,'{X}',inttostr(i),[rfReplaceAll]);
    s:=StringReplace(s,'{Y}',inttostr(j),[rfReplaceAll]);
    s:=StringReplace(s,'{left}',inttostr((strtointdef(edit3.Text,7)+i-j-1)*w),[rfReplaceAll]);
    s:=StringReplace(s,'{top}',inttostr((i+j)*h),[rfReplaceAll]);

    summ:=summ+s;
    ProgressBar1.Position:=ProgressBar1.Position+1;
    Application.ProcessMessages;

    end;
memo2.Text:=summ
end;

function TForm1.getx(w,h:integer):integer;
begin
result:=(strtointdef(edit4.text,92)-w) div 2;
end;

function TForm1.gety(w,h:integer):integer;
begin
result:=(strtointdef(edit5.text,48)-h);
end;

procedure TForm1.Button2Click(Sender: TObject);
var i:integer;
    s:string;
    summ:string;
begin
ProgressBar2.Position:=0;
ProgressBar2.Max:=100;
summ:='';
i:=1;
while fileexists('../images/town/tile'+inttostr(i)+'.png') do
  begin
  s:=memo3.text;
  s:=StringReplace(s,'{ID}',inttostr(i),[rfReplaceAll]);
  s:=StringReplace(s,'{left}',inttostr(getx(1,1)),[rfReplaceAll]);
  s:=StringReplace(s,'{top}',inttostr(gety(1,1)),[rfReplaceAll]);
  summ:=summ+s;
  ProgressBar2.Position:=ProgressBar1.Position+1;
  Application.ProcessMessages;
  i:=i+1;
  end;
memo4.Text:=summ
end;

end.
